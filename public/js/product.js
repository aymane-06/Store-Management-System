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

                            <td class="p-4 space-x-2 whitespace-nowrap">
                                <button onclick="editProduct(${product.id})" type="button" id="updateProductButton" data-drawer-target="drawer-update-product-default" data-drawer-show="drawer-update-product-default" aria-controls="drawer-update-product-default" data-drawer-placement="right" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                                    Update
                                </button>
                                <button type="button" id="deleteProductButton" data-drawer-target="drawer-delete-product-default" data-drawer-show="drawer-delete-product-default" aria-controls="drawer-delete-product-default" data-drawer-placement="right" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                    Delete item
                                </button>
                            </td>
                        </tr>`;
                        tbody.appendChild(tr);
     })   
        
}
getProduct();
// let imageFile;
// document.getElementById('dropzone-file').addEventListener('change',(event)=>{
// const file= event.target.files[0];
// if(file){
//     imageFile=file;
// }
// });

// function saveImg(event){
//     // event.preventDefault();
//     let formData=new FormData();
//     formData.append('key','46f3ef596ef4ae6d12f3d2559e29c3b7');
//     formData.append('image',imageFile)
//      fetch('https://api.imgbb.com/1/upload',{
//         method : 'POST',
//         body: formData
//     })
//     .then(res=>res.json())
//     .then(data=>{
//         console.log(data);
        
//     })
// }


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