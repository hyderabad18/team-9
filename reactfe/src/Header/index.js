import React, { Component } from "react";

// class Header extends Component
// {
//     render()
//     {
//         return (this.props.loggedIn ? <h3>Sunny</h3> : <h3>Login</h3>)
//     }
// }

class Header extends Component
{
    state = {
        isLoggedIn : this.props.isLoggedIn
    }

    toggleLoggedIn = () => {
        this.setState(prev => ({isLoggedIn : !prev.isLoggedIn}))
    }

    render()
    {
        const {title} = this.props
        const {isLoggedIn} = this.state
        return (
            <div className = "headercontent">
                <h2 className = "title">{title}</h2>
                <div className = "menu" onClick = {this.toggleLoggedIn}>
                    {
                        isLoggedIn ?
                        <span>Logout</span> :
                        <span>Login</span>
                    }
                </div>
            </div>
        )
    }
}

export default Header