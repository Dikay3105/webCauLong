// Hàm tìm kiếm sản phẩm
function searchEngine(event) {
  event.preventDefault(); // Ngăn chặn sự kiện mặc định của form

  const searchText = document.getElementById('search_text').value.toLowerCase(); // Lấy nội dung tìm kiếm và chuyển về chữ thường
  const searchList = document.getElementById('searchList');
  searchList.innerHTML = ''; // Xóa kết quả tìm kiếm trước đó

  // Lặp qua danh sách sản phẩm để tìm kiếm
  const matchedProducts = products.filter(product => {
      const productName = product.name.toLowerCase();
      return productName.includes(searchText) && searchText !== ''; // Kiểm tra tên sản phẩm có chứa từ khóa tìm kiếm không
  });

  if (matchedProducts.length > 0) {
      matchedProducts.forEach(product => {
          const listItem = document.createElement('li');
          listItem.textContent = `${product.name} - ${product.description}`;
          listItem.classList.add('search-result'); // Thêm lớp CSS để đổi màu kết quả tìm kiếm
          searchList.appendChild(listItem);
      });
  } else {
      const noResultItem = document.createElement('li');
      noResultItem.textContent = 'Không tìm thấy sản phẩm nào!';
      searchList.appendChild(noResultItem);
  }
}
