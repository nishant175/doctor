<?php

namespace WebDevEtc\BlogEtc\Traits;

use Exception;
use File;
use Illuminate\Http\UploadedFile;
use Image;
use RuntimeException;
use WebDevEtc\BlogEtc\Events\UploadedImage;
use WebDevEtc\BlogEtc\Models\BlogEtcPost;

trait UploadFileTrait
{
    /** How many tries before we throw an Exception error */
    public static $num_of_attempts_to_find_filename = 100;

    /**
     * If false, we check if the blog_images/ dir is writable, when uploading images.
     *
     * @var bool
     */
    protected $checked_blog_image_dir_is_writable = false;

    /**
     * Small method to increase memory limit.
     * This can be defined in the config file. If blogetc.memory_limit is false/null then it won't do anything.
     * This is needed though because if you upload a large image it'll not work.
     */
    protected function increaseMemoryLimit()
    {
        // increase memory - change this setting in config file
        if (config('blogetc.memory_limit')) {
            @ini_set('memory_limit', config('blogetc.memory_limit'));
        }
    }

    /**
     * @param BlogEtcPost $new_blog_post
     * @param $suggested_title - used to help generate the filename
     * @param $image_size_details - either an array (with 'w' and 'h') or a string (and it'll be uploaded at full size, no size reduction, but will use this string to generate the filename)
     * @param $photo
     *
     * @throws Exception
     *
     * @return array
     */
    protected function UploadAndResize(BlogEtcPost $new_blog_post = null, $suggested_title, $image_size_details, $photo)
    {
        $image_filename = $this->getImageFilename($suggested_title, $image_size_details, $photo);
        $destinationPath = $this->image_destination_path();

        $resizedImage = Image::make($photo->getRealPath());

        if (is_array($image_size_details)) {
            $w = $image_size_details['w'];
            $h = $image_size_details['h'];

            if (isset($image_size_details['crop']) && $image_size_details['crop']) {
                $resizedImage = $resizedImage->fit($w, $h);
            } else {
                $resizedImage = $resizedImage->resize($w, $h, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
        } elseif ('fullsize' === $image_size_details) {
            $w = $resizedImage->width();
            $h = $resizedImage->height();
        } else {
            throw new Exception('Invalid image_size_details value');
        }

        $resizedImage->save($destinationPath.'/'.$image_filename, config('blogetc.image_quality', 80));

        event(new UploadedImage($image_filename, $resizedImage, $new_blog_post, __METHOD__));

        return [
            'filename' => $image_filename,
            'w'        => $w,
            'h'        => $h,
        ];
    }

    /**
     * Get a filename (that doesn't exist) on the filesystem.
     *
     * Todo: support multiple filesystem locations.
     *
     * @param $image_size_details - either an array (with w/h attributes) or a string
     *
     * @throws RuntimeException
     *
     * @return string
     */
    protected function getImageFilename(string $suggested_title, $image_size_details, UploadedFile $photo)
    {
        $base = $this->generate_base_filename($suggested_title);

        // $wh will be something like "-1200x300"
        $wh = $this->getWhForFilename($image_size_details);
        $ext = '.'.$photo->getClientOriginalExtension();

        for ($i = 1; $i <= self::$num_of_attempts_to_find_filename; $i++) {
            // add suffix if $i>1
            $suffix = $i > 1 ? '-'.str_random(5) : '';

            $attempt = str_slug($base.$suffix.$wh).$ext;

            if (!File::exists($this->image_destination_path().'/'.$attempt)) {
                // filename doesn't exist, let's use it!
                return $attempt;
            }
        }

        // too many attempts...
        throw new RuntimeException("Unable to find a free filename after $i attempts - aborting now.");
    }

    /**
     * @return string
     */
    protected function generate_base_filename(string $suggested_title)
    {
        $base = substr($suggested_title, 0, 100);
        if (!$base) {
            // if we have an empty string then we should use a random one:
            $base = 'image-'.str_random(5);

            return $base;
        }

        return $base;
    }

    /**
     * Get the width and height as a string, with x between them
     * (123x456).
     *
     * It will always be prepended with '-'
     *
     * Example return value: -123x456
     *
     * $image_size_details should either be an array with two items ([$width, $height]),
     * or a string.
     *
     * If an array is given:
     * getWhForFilename([123,456]) it will return "-123x456"
     *
     * If a string is given:
     * getWhForFilename("some string") it will return -some-string". (max len: 30)
     *
     * @param array|string $image_size_details
     *
     * @throws RuntimeException
     *
     * @return string
     */
    protected function getWhForFilename($image_size_details)
    {
        if (is_array($image_size_details)) {
            return '-'.$image_size_details['w'].'x'.$image_size_details['h'];
        } elseif (is_string($image_size_details)) {
            return '-'.str_slug(substr($image_size_details, 0, 30));
        }

        // was not a string or array, so error
        throw new RuntimeException('Invalid image_size_details: must be an array with w and h, or a string');
    }

    /**
     * @throws RuntimeException
     *
     * @return string
     */
    protected function image_destination_path()
    {
        $path = public_path('/'.config('blogetc.blog_upload_dir'));
        $this->check_image_destination_path_is_writable($path);

        return $path;
    }

    /**
     * Check if the image destination directory is writable.
     * Throw an exception if it was not writable.
     *
     * @param $path
     *
     * @throws RuntimeException
     */
    protected function check_image_destination_path_is_writable($path)
    {
        if (!$this->checked_blog_image_dir_is_writable) {
            if (!is_writable($path)) {
                throw new RuntimeException("Image destination path is not writable ($path)");
            }
            $this->checked_blog_image_dir_is_writable = true;
        }
    }
}
