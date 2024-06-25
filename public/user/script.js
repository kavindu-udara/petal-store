const changeProfilePic = () => {
    const profilePrev = document.getElementById('profile-image-prev');
    const img = document.getElementById('profile-img-selector');
    const allowedImgTypes = "image/jpeg, image/png, image/jpeg, image/svg+xml";
    img.onchange = () => {
        const file = img.files[0];
        const fileType = file.type;

        const URL = window.URL.createObjectURL(file);

        allowedImgTypes.includes(fileType)
            ? (profilePrev.src = URL)
            :
            alert('unsported file type');
    };
}