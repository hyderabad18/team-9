import React, { Component } from "react";
import { BrowserRouter as Router, Route, Link, Switch } from "react-router-dom";

// class College_list extends Component
// {
//     render()
//     {
//         return(
//             <div>
//         const {url} = "http://127.0.0.1:8000/api/v1/colleges/";
//         fetch({url}).then(
//             function(response)
//             {
//                 response.json().then(
//                     function(data)
//                     {
//                         console.log(data)
//                     }
//                 )
//             }
//         )
//         </div>
//         )
//     }
// }

class College_list extends Component
{
    state = {
        data : null
    }

    componentDidMount()
    {
        fetch('http://127.0.0.1:8000/api/v1/colleges/')
        .then(response => response.json())
        .then(responseJson => {
            console.log(responseJson);
            this.setState({data : responseJson})
        })
        .catch("Error in fetching data");
    }

    render()
    {
        return (
            <div>
                <h2>College List</h2>
                {
                    this.state.data && this.state.data.map(college => 
                    <p key = {college.id}> {college.id}
                    <Link to={`/colleges/${college.id}/`}>
                     {college.name}
                    </Link>
                    <br/>   
                    </p>
                    )
                }
            </div>
        )
    }

}

export default College_list