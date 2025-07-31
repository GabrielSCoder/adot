document.addEventListener("DOMContentLoaded", () => {
    const img = document.getElementById("imagem")
    const btn_form = document.getElementById('preview_btn_form');
    const btn_close_modal = document.getElementById('btn_close_preview_imgs');
    const dl_prv1 = document.getElementById("del_preview1");
    const dl_prv2 = document.getElementById("del_preview2");
    const fake_modal = document.getElementById("fake_scroll");

    if (img) {

        img.addEventListener('change', (event) => {
            validarArquivos();
            const input = event.target;
            console.log(input.files)
            const files = input.files;
            const preview = document.getElementById("preview");
            const preview2 = document.getElementById("preview2");
            const div1 = document.getElementById("pv_div_1");
            const div2 = document.getElementById("pv_div_2");
            preview.src = "";
            // preview.style.display = 'none';
            preview2.src = "";
            // preview2.style.display = 'none';

            if (files) {
                if (files.length >= 1) {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        preview.src = e.target.result;
                        // preview.style.display = 'block';
                        div1.style.display = 'block';
                    }

                    reader.readAsDataURL(input.files[0]);
                }

                if (files.length >= 2) {
                    const reader2 = new FileReader();

                    reader2.onload = function (e) {
                        preview2.src = e.target.result;
                        // preview2.style.display = 'block';
                        div2.style.display = 'block';
                    }

                    reader2.readAsDataURL(input.files[1]);
                }
            };
        })
    }


    if (dl_prv1) {
        dl_prv1.addEventListener('click', () => {
            if (confirm("Deseja excluir a imagem?")) {
                document.getElementById("preview").src = "";
                document.getElementById("pv_div_1").style.display = "none";
                const input = document.getElementById("imagem");
                const files = input.files;
                const newFiles = new DataTransfer();

                for (let i = 0; i < files.length; i++) {
                    if (i !== 0) {
                        newFiles.items.add(files[i]);
                    }
                }

                input.files = newFiles.files;
            }
        });
    }

    if (dl_prv2) {

        dl_prv2.addEventListener('click', () => {
            if (confirm("Deseja excluir a imagem?")) {
                document.getElementById("preview2").src = "";
                document.getElementById("pv_div_2").style.display = "none";
                const input = document.getElementById("imagem");
                const files = input.files;
                const newFiles = new DataTransfer();

                for (let i = 0; i < files.length; i++) {
                    if (i !== 0) {
                        newFiles.items.add(files[i]);
                    }
                }

                input.files = newFiles.files;
            }
        });
    }

    function validarArquivos() {
        const input = document.getElementById('imagem');
        if (input.files.length > 2) {
            alert("Você só pode enviar no máximo 2 imagens.");
            input.value = "";
            return false;
        }
        if (input.files.length > 0) {
            btn_form.removeAttribute("hidden");
        } else {
            btn_form.setAttribute("hidden", "");
        }

        return true;
    }

    function getScrollbarWidth() {
        return window.innerWidth - document.documentElement.clientWidth;
    }

    if (btn_form) {
        btn_form.addEventListener('click', (event) => {
            event.preventDefault();
            const modal = document.getElementById("form_preview_modal");
            const main = document.getElementById("main");
            if (getComputedStyle(modal).display === "none") {
                modal.style.display = "flex"
                document.documentElement.classList.add("modal-open");
                document.body.classList.add("modal-open");
                // fake_modal.style.display = "block";
            }
        })
    }

    if (btn_close_modal) {
        btn_close_modal.addEventListener('click', () => {
            const modal = document.getElementById("form_preview_modal");
            const main = document.getElementById("main");
            modal.setAttribute("hidden", "");
            modal.style.display = "none"
            document.documentElement.classList.remove("modal-open");
            document.body.classList.remove("modal-open");
            // fake_modal.style.display = "none";
        });
    }
});