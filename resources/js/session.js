document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".sign-btn");

    buttons.forEach(btn => {
        btn.addEventListener("click", () => {
            const cours = btn.dataset.cours;
            alert("Signature enregistrée pour : " + cours);
        });
    });
});
