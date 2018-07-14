import React, { Component } from "react";
import { BrowserRouter as Router, Route, Link, Switch } from "react-router-dom";
class College_details extends Component
{
    state = {
        data : null
    }

    componentDidMount()
    {
        fetch(`http://127.0.0.1:8000/api/v1/colleges/${this.props.match.params.id}/students/`)
        .then(response => response.json())
        .then(responseJson =>
            {
                console.log(responseJson);
                this.setState({data : responseJson})
            }
        )
        .catch("Error in fetching")
    }

    render()
    {
        return(
            <div>
                <h2>Students List</h2>
                {
                    this.state.data && this.state.data.map(student =>
                    <p key = {student.id}> {student.id}
                    <Link to = {`/colleges/${this.props.match.params.id}/${student.id}`}>
                    {student.name}
                    </Link>
                    </p>
                    )
                }
            </div>
        )
    }
}

export default College_details