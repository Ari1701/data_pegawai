document.addEventListener("DOMContentLoaded", function() {
    var modal = document.getElementById("deleteModal");
    var span = document.getElementsByClassName("close")[0];

    function showDeleteModal(id) {
        document.getElementById("deleteId").value = id;
        modal.style.display = "block";
    }

    function closeDeleteModal() {
        modal.style.display = "none";
    }

    span.onclick = function() {
        closeDeleteModal();
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            closeDeleteModal();
        }
    }

    // Expose functions to global scope
    window.showDeleteModal = showDeleteModal;
    window.closeDeleteModal = closeDeleteModal;
});
