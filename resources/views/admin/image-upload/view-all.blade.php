<hr>
<div class="container-fluid">


<div class="row">

@forelse($images as $image)

<div class="col-md-3 col-sm-4 col-xs-6">

    <a href="javascript:void(0)" ><img onclick="addImageToHidden('{{ $image->image }}')" class="img-thumbnail" src="{{ asset($image->image) }}" style="width:100%"></a>

</div>

@empty
    <h4 class="text-center"> No data available </h4>

@endforelse

</div>

</div>

<script>

    function addImageToHidden(image_path)
    {
        var image_full_path = "{{ asset('') }}/"+image_path;

        var hidden_type = $('#image_type').val();
        setTimeout(function(){
            $("#hidden-image-"+hidden_type).val(image_path);
            $("#hidden-"+hidden_type).html('<img class="img-thumbnail" width="150px" src="'+ image_full_path +'">');
            $("#close-model").click();
        }, 300);
    }

</script>