
<div class="form-group last:mb-0">
    <label class="change-photo" for="file-zone">
    <p> <b class="text-gray-800">Upload hình ảnh:</b> <span class="text-danger mt-2 mb-2 text-sm"><?=$dimension?></span></p>
        <div class="rounded photoUpload-preview flex items-center justify-left " id="photoUpload-preview">
            <img class="rounded img-upload max-w-[100%]" src="<?=$photoDetail?>" onerror="src='assets/images/noimage.png'" alt="Alt Photo"/>
        </div>
    </label>
    <div class="custom-file my-custom-file mt-3">
        <label for="file-zone" class="photo-zone block" id="photo-zone">
            <input type="file" class="form-control file-zone"  name="file" id="file-zone">
        </label>
    </div>
</div>