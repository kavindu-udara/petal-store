const selectImage = (id) => {
    const image = document.getElementById(id);

    const allowedImgTypes = "image/jpeg, image/png, image/jpeg, image/svg+xml";

    const preview = document.getElementById(id + "-preview");

    image.onchange = () => {
        const file = image.files[0];
        const fileType = file.type;

        const URL = window.URL.createObjectURL(file);

        allowedImgTypes.includes(fileType)
            ? (preview.src = URL)
            : alert("unsported file type");
    };
};

const showandHidePopup = (id) => {
    const popup = document.getElementById(id);
    popup.classList.toggle('hidden');
}
