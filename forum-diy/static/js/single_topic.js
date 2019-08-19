const commentID = new URL(location.href).searchParams.get('com')
// Returns 2008 for href = "http://localhost/search.php?year=2008".
// Or in two steps:
// const params = new URL(location.href).searchParams;
// const year = params.get('year');
console.log(commentID);
if(commentID != null){
    const comment = document.getElementById(commentID);
    comment.scrollIntoView({
        behavior: 'smooth',
        block: 'start'});
}