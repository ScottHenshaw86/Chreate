document.querySelectorAll('.modal i').forEach(icon =>{
    icon.onclick = () => {
        document.querySelector('.modal').style.display = 'block';
        document.querySelector('.modal i').src = image.getAttribute('src');
    }
});

document.querySelector('.modal span').onclick = () =>{
    document.querySelector('.modal').style.display = 'none';
}

if() {
    
}