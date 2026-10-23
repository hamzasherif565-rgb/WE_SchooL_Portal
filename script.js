const modal = document.getElementById("studentModal");

document.getElementById("openModal").onclick = function () {
    modal.classList.add("show");
    document.body.classList.add("modal-open");
};


function closeStudentModal() {
    modal.classList.remove("show");
    document.body.classList.remove("modal-open");
}

document.getElementById("closeModal").onclick = closeStudentModal;


modal.addEventListener("click", function (event) {
    if (event.target === modal) {
        closeStudentModal();
    }
});

document.addEventListener("keydown", function (event) {
    if (event.key === "Escape") {
        closeStudentModal();
    }
});


