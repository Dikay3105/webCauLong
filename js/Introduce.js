$(document).ready(() => {
    show(tabName);
})

function show(tabName) {
    // Ẩn tất cả các nội dung tab
    var vipContent = document.querySelectorAll('.right-content');
    vipContent.forEach(function (content) {
      content.style.display = 'none';
    });
  
    // Hiển thị nội dung của tab được click
    document.getElementById(tabName).style.display = 'block';
}
