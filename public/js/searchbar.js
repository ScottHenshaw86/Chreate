// modal

document.querySelectorAll('button i').forEach(i => {
    post.addEventListener('click', (e) => {
        const postContent = post.innerHTML;
        const modal = document.querySelector('.modal');
        const postContentDiv = modal.querySelector('.post-content');
        postContentDiv.innerHTML = postContent;

        modal.style.display = 'block';
    });
});

// Close the modal when clicking on the close button
document.querySelector('.modal span').onclick = () => {
    document.querySelector('.modal').style.display = 'none';
};