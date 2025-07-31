const img = document.getElementById("imagem")

if (img) {

    img.addEventListener('change', (event) => {
        validarArquivos();
        const input = event.target;
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

const dl_prv1 = document.getElementById("del_preview1")
const dl_prv2 = document.getElementById("del_preview2")

if (dl_prv1) {
    dl_prv1.addEventListener('click', () => {
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
    });
}

if (dl_prv2) {

    dl_prv2.addEventListener('click', () => {
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
    });
}

function validarArquivos() {
    const input = document.getElementById('imagem');
    if (input.files.length > 2) {
        alert("Você só pode enviar no máximo 2 imagens.");
        input.value = "";
        return false;
    }
    return true;
}

const input = document.getElementById('imagem');
const btn_form = document.getElementById('preview_btn_form');

if (input) {
    input.addEventListener('change', () => {
        if (input.files.length > 2) {
            alert("Você só pode enviar no máximo 2 imagens.");
            input.value = "";
            return false;
        }
        if (input.files.length > 0) {
            btn_form.removeAttribute("hidden");
        } else {
            btn_form.setAttribute("hidden", "");
            return true;
        }
    })

    btn_form.addEventListener('click', () => {
        const modal = document.getElementById("form_preview_modal");
        if (modal.hasAttribute('hidden')) {
            modal.removeAttribute("hidden");
        }
    })
}