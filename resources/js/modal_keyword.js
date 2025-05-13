document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("editKeywordForm");
    const idInput = document.getElementById("edit-id");
    const nameInput = document.getElementById("edit-name");

    document.querySelectorAll(".fa-pen").forEach(function (icon) {
        icon.addEventListener("click", function () {
            const id = this.dataset.id;
            const name = this.dataset.name;
            const slug = this.dataset.slug;

            idInput.value = id;
            nameInput.value = name;

            form.action = `/admin/keywords/${id}`;
        });
    });
});
