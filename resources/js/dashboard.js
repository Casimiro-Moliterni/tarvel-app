
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector("#create-form");
            const map = document.querySelector("#map");
            const addForm = document.querySelector("#btn-add");
            form.classList.add('disabled');
            map.classList.add('disabled');
            addForm.addEventListener('click', function() {
                form.classList.toggle("disabled");
                map.classList.toggle("disabled");
            });
            console.log(map)
        });