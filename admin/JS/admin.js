document.addEventListener('DOMContentLoaded', function () {
    let btnRss = document.querySelectorAll('.btnRed');
    let body = document.querySelector('body');

    for (const btnR of btnRss) {
        btnR.addEventListener('click', function (event) {
            event.preventDefault(); // Ajouté pour empêcher le comportement par défaut du lien

            let dataIdBook = this.dataset.idbook;
            let dataTitle = this.dataset.title;
            document.body.style.overflow = "hidden";

            let modalBg = document.createElement('div');
            modalBg.classList.add('block-modal');
            body.append(modalBg);

            const boxDelete = document.createElement("div");
            boxDelete.setAttribute("id", "box-delete-book");
            boxDelete.classList.add("active-box-delete-book");
            body.append(boxDelete);

            //p static
            const confirmation = document.createElement("p");
            confirmation.setAttribute("id", "txt-box-delete-category");
            boxDelete.appendChild(confirmation);
            confirmation.innerHTML = `Êtes-vous sûr de vouloir supprimer ${dataTitle} ? `;

            //popup
            const btnCancel = document.createElement("a");
            btnCancel.setAttribute("id", "btn-cancel-delete-category");
            boxDelete.appendChild(btnCancel);
            btnCancel.innerHTML = "Annuler";

            //close modal
            btnCancel.addEventListener('click', function () {
                document.body.style.overflow = "auto";
                boxDelete.remove();
                modalBg.remove();


            })


            const btnConfirmed = document.createElement("a");
            btnConfirmed.setAttribute("id", "btn-confirmed-delete-book");


            if (window.location.href.includes("category.php")) {
                deleteUrl = "./deletecategory.php?id=" + dataIdBook;
            } else if (window.location.href.includes("genre.php")) {
                deleteUrl = "./deletegenre.php?id=" + dataIdBook;
            }
            else if (window.location.href.includes("article.php")) {
                deleteUrl = "./deletearticle.php?id=" + dataIdBook;
            }
            else if (window.location.href.includes("dashboard-admin.php")) {
                deleteUrl = "./deletearticle.php?id=" + dataIdBook;
            } else if (window.location.href.includes("user.php")) {
                deleteUrl = "./delete-user.php?id=" + dataIdBook;
            }
            btnConfirmed.setAttribute("href", deleteUrl);

            // sa permet de définir dynamiquement l'URL de suppression en fonction de la page actuelle. Ainsi, lorsque vous cliquez sur le bouton de confirmation, il envoie la demande de suppression à la bonne URL.

            boxDelete.appendChild(btnConfirmed);
            btnConfirmed.innerHTML = "Confirmer";



        })
    }
})




function showSuccessModal() {
    // Récupérer le corps du document
    const body = document.querySelector('body');

    // Créer la modal pour la suppression réussie
    let modalSuccess = document.createElement('div');
    modalSuccess.classList.add('block-modal');
    body.append(modalSuccess);

    const boxSuccess = document.createElement("div");
    boxSuccess.setAttribute("id", "box-success-delete-book");
    boxSuccess.classList.add("active-box-delete-book");
    modalSuccess.append(boxSuccess);

    //p static
    const successMsg = document.createElement("p");
    successMsg.setAttribute("id", "txt-box-success-delete-category");
    boxSuccess.appendChild(successMsg);
    successMsg.innerHTML = `La suppression a été effectuée avec succès.`;

    //bouton fermer modal
    const btnClose = document.createElement("a");
    btnClose.setAttribute("id", "btn-close-success-modal");
    boxSuccess.appendChild(btnClose);
    btnClose.innerHTML = "Fermer";

    btnClose.addEventListener('click', function () {
        modalSuccess.remove();
        history.back();
    });
}

