let users=[];
async function getUser() {
    await fetch('/Store-Management-System//app/Controller/showUsers.php')
        .then(res=>res.json())
        .then(data=>{
            console.log(data);
            users=data;
            
        })
    let tbody=document.getElementById('tbody');   
    tbody.innerHTML="";
    users.forEach(user => {
        
    
    let tr=document.createElement('tr');
    tr.innerHTML=`<td class="w-4 p-4">
                               ${user.UserId}
                            </td>
                            <td class="flex items-center p-4 mr-12 space-x-6 whitespace-nowrap">
                                    <div class="text-base font-semibold text-gray-900 dark:text-white">${user.name}</div>
                            </td>
                            <td class="max-w-sm p-4 overflow-hidden text-base font-normal text-gray-500 truncate xl:max-w-xs dark:text-gray-400">${user.email}</td>
                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">${user.role}</td>
                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">${user.created_at}</td>
                            <td class="p-4 text-base font-normal text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="flex items-center">
                                     <div  class="h-2.5 w-2.5 rounded-full ${user.status==='active'? 'bg-green-400':'bg-red-400'} mr-2 status"></div>  ${user.status}
                                </div>
                            </td>
                            <td class="p-4 space-x-2 whitespace-nowrap">
                                
                                <button onclick="confirmation(${user.UserId},'${user.status}')" type="button" data-modal-toggle="delete-user-modal" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white ${user.status==='disabled'?'bg-green-600 hover:bg-green-800':'bg-red-600 hover:bg-red-800'} rounded-lg focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                    ${user.status==='disabled'?'Enable':'Disable'} user
                                </button>
                            </td>`; 
                            tbody.appendChild(tr);
                        });
                        
                      
}
getUser();
function confirmation(id,status){
    // console.log(status);
    
    let editModal=document.getElementById('edit-user-modal');
    editModal.classList.remove('hidden');
    editModal.innerHTML=`<div class="relative w-full h-full max-w-md px-4 md:h-auto top-[30%] left-[35%]">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
            <!-- Modal header -->
            <div class="flex justify-end p-2">
                <button onclick='closeModal()' type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white" data-modal-toggle="edit-user-modal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 pt-0 text-center">
                <svg class="w-16 h-16 mx-auto ${status==='active'?'text-red-600':'text-green-600'}  fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="mt-5 mb-6 text-lg text-gray-500 dark:text-gray-400">Are you sure you want to ${status==='active'?'Disable':'Enable'} this user?</h3>
                <a onclick="editStatus(${id},'${status}')"  href="#" class="text-white ${status==='active'?'bg-red-600 hover:bg-red-800 ':'bg-green-600 hover:bg-green-800 '} focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2 dark:focus:ring-red-800">
                    Yes, I'm sure
                </a>
                <a onclick="closeModal()" href="#" class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 border border-gray-200 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700" data-modal-toggle="edit-user-modal">
                    No, cancel
                </a>
            </div>
        </div>
    </div>`;
}

function closeModal(){
    let editModal=document.getElementById('edit-user-modal');
    editModal.classList.add('hidden');
}

async function editStatus(id,status){
    if(status==='active'){
        status='disabled'
    }else{
        status='active'
    }
     
    console.log(status);
    
    
    
    await fetch(`/Store-Management-System/app/Controller/editUser.php?id=${id}&status=${status}`)

    getUser();
    let editModal=document.getElementById('edit-user-modal');
    editModal.classList.add('hidden');
    // window.location.reload();
}


