import React , { Component } from "react";

class LoginForm extends Component
{
    state = { name : '', password: ''}

    saveName = (event) => {
        const {target : {value}} = event; //eqvivalent to  const value = event.target .value
        this.setState(
            {name : value}
        )
    }

    savePass = (event) => {
        const {target : {value}} = event;
        this.setState(
            {password : value}
        )
    }

    submit = (event) =>{
        const {name, password} = this.state
        // fetch('http://localhost:8000/api/v1/token/', {
        // method : 'post',
        // headers : {
        //     "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
        // },
        // body: `username=${name}&password =&{pass}`
        // }).then(res => res.json()).then(response =>{
        //     console.log('response', response)
        // })
        console.log(name)
        console.log(password)
    }

    render()
    {
        return(
            <div>
                <input onChange = {this.saveName} name = 'name'/><br/>
                <input type = "password" onChange = {this.savePass} name = 'password'/><br/>
                <input type = "submit" value = "submit" onClick = {this.submit} name = "submit"/>

            </div>
        )
    }
}

export default LoginForm