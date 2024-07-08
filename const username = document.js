const username = document.getElementById('username')
const password = document.getElementById('password')
const buttom = document.getElementById('buttom')

buttom.addEventListener('click', (e) =>{
    e.preventDefault()
    const data = {
        username: username.value,
        password: password.value
    }
    console.log(data)
})