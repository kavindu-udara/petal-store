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

// const showProductHidePopup = (id) => {
//     const popup = document.getElementById(id);
//     popup.classList.toggle('hidden');
// }
// const showUnhidePopup = (id) => {
//     const popup = document.getElementById(id);
//     popup.classList.toggle('hidden');
// }

// const deleteProduct = (id) => {
    
//     // const form = document.createElement('form');
//     // form.action = route('seller.product.update', id);
//     // form.method = 'POST';
//     // form.appendChild(document.createElement('input')).setAttribute('type', 'hidden');
//     // document.body.appendChild(form);
//     // form.submit();

//     const f = new FormData();
//   f.append("id", id);

//   const r = new XMLHttpRequest();

//   r.onreadystatechange = () => {
//     if (r.readyState == 4 && r.status == 200) {
//       var t = r.responseText;
//     //   t.includes("success") ? refreshPage() : null;
//     console.log(t);
//     alert(t);
//     }
//   };

//   r.open("POST", route('seller.product.update', id), true);
//   r.send(f);

// }