const cookies=document.cookie;
// console.log(cookies);

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
    return null;
  }

  if (getCookie("error")==='1') {
    
    window.onload = function () {
        const button = document.getElementById('createProductButton');
        console.log(button);
        // button.click();
        alert('all inputs are required');
        setTimeout(() => button.click(), 1000);


        
        
        document.cookie = "error=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    };
}
function clearForm(){
    let form=document.getElementById('form');
    form.reset();
}
let products=[];
async function getProduct() {
    await fetch('/Store-Management-System/app/Controller/showProduct.php')
        .then(res => res.json())
        .then(data => {
            products=data;
            console.log(products);
            
        })
      let tbody=document.getElementById('tbody'); 
      if(tbody){
      tbody.innerHTML="";
     products.forEach(product=>{
        let tr=document.createElement('tr');
        tr.innerHTML=`<tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            
                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">#${product.id}</td>
                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                <div class="text-base font-semibold text-gray-900 dark:text-white">${product.name}</div>
                            </td>
                            <td class="max-w-sm p-4 overflow-hidden text-base font-normal text-gray-500 truncate xl:max-w-xs dark:text-gray-400">${product.description}</td>
                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"><img src="${product.image_url}" /></td>
                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">$${product.price}</td>
                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">$${product.quantity}</td>

                            <td class="p-4 space-x-2 whitespace-nowrap">
                                <button onclick="editProduct(${product.id})" type="button" id="updateProductButton" data-drawer-target="drawer-update-product-default" data-drawer-show="drawer-update-product-default" aria-controls="drawer-update-product-default" data-drawer-placement="right" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                                    Update
                                </button>
                                <button onclick="deleteProduct(${product.id})" type="button" id="deleteProductButton" data-drawer-target="drawer-delete-product-default" data-drawer-show="drawer-delete-product-default" aria-controls="drawer-delete-product-default" data-drawer-placement="right" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                    Delete item
                                </button>
                            </td>
                        </tr>`;
                        tbody.appendChild(tr);
     })   
    }else{
      let productView=document.getElementById('productView'); 
      products.forEach(product=>{
      productView.innerHTML+=`<div class="bg-white rounded p-4 cursor-pointer hover:-translate-y-1 transition-all relative">
            <div class="mb-4 bg-gray-100 rounded p-2">
              <img src="${product.image_url}" alt="Product 1"
                class="aspect-[33/35] w-full object-contain" />
            </div>

            <div>
              <div class="flex gap-2">
                <h5 class="text-base font-bold text-gray-800">${product.name}</h5>
                <h6 class="text-base text-gray-800 font-bold ml-auto">$${product.price}</h6>
              </div>
              <p class="text-gray-500 text-[13px] mt-2">${product.description}</p>
              <div class="flex items-center gap-2 mt-4">
                <div
                  class="bg-pink-100 hover:bg-pink-200 w-12 h-9 flex items-center justify-center rounded cursor-pointer" title="Wishlist">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16px" class="fill-pink-600 inline-block" viewBox="0 0 64 64">
                    <path
                      d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                      data-original="#000000"></path>
                  </svg>
                </div>
                <button type="button" class="text-sm px-2 h-9 font-semibold w-full bg-blue-600 hover:bg-blue-700 text-white tracking-wide ml-auto outline-none border-none rounded">Add to cart</button>
              </div>
            </div>
          </div>`;

        })   
    }
}
getProduct();



async function editProduct(id){
    let form=document.getElementById('form');
    
    let editedProduct;
    const button = document.getElementById('createProductButton');
    button.click();
    form.setAttribute("action","/Store-Management-System/app/controller/editproduct.php");
    await fetch(`/Store-Management-System/app/controller/editproduct.php?id=${id}`)
    .then(res=>res.json())
    .then(data=>{
        // console.log(data);
        editedProduct=data;
        console.log(editedProduct)
        
        
    })
    let name=document.getElementById('nameP');
    // console.log(name);
    let productId=document.getElementById('id');
    let price=document.getElementById('price');
    let Quantity=document.getElementById('Quantity');
    let description=document.getElementById('description');

    let image=document.getElementById('dropzone-file');

   
    
    productId.value=editedProduct.id;
    // console.log(productId.value);
    
    name.value=editedProduct.name;
    price.value=editedProduct.price;
    Quantity.value=editedProduct.quantity;
    description.value=editedProduct.description;
    image.value=editedProduct.image_url;


}
function formRedirect(){
    let form=document.getElementById('form');
    form.reset();
    form.setAttribute("action","/Store-Management-System/router/web.php");
}

async function deleteProduct(id){
await fetch(`/Store-Management-System/app/controller/deleteProduct.php?id=${id}`)

getProduct();

}


