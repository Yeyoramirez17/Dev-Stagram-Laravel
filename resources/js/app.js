import Dropzone from "dropzone";
import axios from "axios";

import "./bootstrap";

Dropzone.autoDiscover = false;

if (document.getElementById("dropzone")) {
    const dropzone = new Dropzone("#dropzone", {
        dictDefaultMessage: "Sube tu image aquí",
        acceptedFiles: ".png,.jpg,.jpeg,.gif",
        addRemoveLinks: true,
        dictRemoveFile: "Borrar archivo",
        maxFiles: 1,
        uploadMultiple: false,

        init: function () {
            if (document.querySelector('[name="image"]').value.trim()) {
                const imagePublished = {};

                imagePublished.size = 1080;
                imagePublished.name = document.querySelector('[name="image"]').value;

                this.options.addedfile.call(this, imagePublished);
                this.options.thumbnail.call(
                    this,
                    imagePublished,
                    `/uploads/${imagePublished.name}`
                );

                imagePublished.previewElement.classList.add(
                    "dz-success",
                    "dz-complete"
                );
            }
        },
    });

    dropzone.on("success", function (file, response) {
        document.querySelector('[name="image"]').value = response.image;
    });

    // dropzone.on("removedfile", function (file) {
    //     const image = document.querySelector('[name="image"]').value;
    //     const url = "http://localhost:8000/remove-image";

    //     document.querySelector('[name="image"]').value = "";

    //     axios({
    //             url: url,
    //             method: 'POST',
    //             data: {
    //                 'image': image,
    //             }
    //         })
    //         .then(function (response) {
    //             console.log(response);
    //         })
    //         .catch(function (error) {
    //             console.log(error);
    //         });
    // });
}
