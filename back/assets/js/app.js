document.addEventListener("DOMContentLoaded", function(){
    /**
     * Lecture en ariere plan
     */
    let resultat = document.querySelector('.resultat')
    // let apiGet = 'index.php?action=postsApi'
    let apiGet = 'http://localhost:9000/posts';
    fetch(apiGet)
        .then(res => {
            console.log('hello res')
            if(res.ok){
                return res.json()
            }else{
                console.log(' res pas ok ')
            }
        })
        .then(data =>{
            console.log(data)
            data.forEach(elm => {
                resultat.innerHTML += `
                    <tr>
                        <td> 
                            ${elm.id}
                        </td>
                        <td> 
                            ${elm.title}
                        </td>
                        <td> 
                        ${elm.description}
                    </td>
                    <td> 
                            ${elm.imageUrl}
                          </td>
                         <td>${elm.createdDate}</td>
                         <td>${elm.snaps}</td>
                        <td>${elm.location}</td>
                        <td><a href="http://localhost:9000/admin/delete/${elm.id}">Edit A finir</a></td> 
                        <td><a href="http://localhost:9000/admin/delete/${elm.id}">delete</a></td>
                </tr> 
                
             `
            });
        })
        .catch(e => {
            console.log('erreur de lecture'+e);
        })


// for send data avec POST
// //let info = document.querySelector('#info');
// let envoyer = document.querySelector('#envoyer')
// let leForm = document.querySelector('#leForm')
// let argent = document.querySelector('#argent')
// let message = document.querySelector('#message')
// let cible = document.querySelector('#cible')
//
// const api = '/api/sends';

    /**
     *  la fonction callback envoyer a l'evenement submit
     */
// baldeApi = (e) => {
//     e.preventDefault();
//     let dataForm = new FormData(leForm);
//
//     fetch(api,{
//         method: "POST",
//         body:  dataForm
//     })
//     .then(res => {
//         if(res.ok){
//             return res.text()
//         }
//     })
//     .then(data =>{
//         console.log(data)
//     })
//     .catch(e => {
//         console.log('erreur de lecture'+e);
//     })
// }
//
// leForm.addEventListener('submit',baldeApi,false)
});

