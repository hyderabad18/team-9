import React, { Component } from "react";
import { BrowserRouter as Router, Route, Link, Switch } from "react-router-dom";

class Student_details extends Component
{
    state = {
        data: null
    }

    componentDidMount()
    {
        fetch(`http://127.0.0.1:8000/api/v1/colleges/${this.props.match.params.college_id}/students/${this.props.match.params.student_id}`)
        .then(response => response.json())
        .then(responseJson => 
            {
                this.setState({data : responseJson})
            }
        )
        .catch("Error while reading")
    }

    render()
    {
        return(
            <div>
                <h2>Student Details</h2>
                {
                    this.state.data && this.state.data.mocktest1 &&
                    <p key = {this.state.data.id}>
                        {this.state.data.name} {this.state.data.mocktest1.problem1} {this.state.data.mocktest1.problem2} {this.state.data.mocktest1.problem3} {this.state.data.mocktest1.problem4} {this.state.data.mocktest1.total}
                    </p>
                }
            </div>
        )
    }
}

export default Student_details