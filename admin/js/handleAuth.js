import {prevent_resub} from './base.js'
prevent_resub()

const sel_LoginSwitch = document.getElementById('loginSwitch')
const sel_RegisterSwitch = document.getElementById('registerSwitch')

const sel_loginContainer = document.getElementById('login_register_container')


const reset_color = "#000000"
const reset_background = "#FFFFFF"

const highlight_color = "#FFFFFF"
const highlight_background = "#000000"

window.onload = async () => {
	document.title = document.title + " - Login"
}


function ch_siteTitle(tx){
  	document.title = document.title.replace(' - Login','').replace(' - Register', '') + tx
}

function resetHighlight(elm){
  elm.style.color = reset_color
  elm.style.background = reset_background
}

function highlightBtn(elm){
  elm.style.color = highlight_color
  elm.style.background = highlight_background
}

sel_LoginSwitch.onclick = async (e) => {
  	highlightBtn(e.target)
  	resetHighlight(sel_RegisterSwitch)
  	ch_siteTitle(' - Login')
	const res = await fetch('login.php')
  	const data = await res.text()
  	sel_loginContainer.innerHTML = data
}


sel_RegisterSwitch.onclick = async (e) => {
  	highlightBtn(e.target)
  	resetHighlight(sel_LoginSwitch)
  	ch_siteTitle(' - Register')
	const res = await fetch('register.php')
  	const data = await res.text()
  	sel_loginContainer.innerHTML = data
}

