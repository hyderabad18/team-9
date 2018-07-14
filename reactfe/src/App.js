import React, { Component } from 'react';
import logo from './logo.svg';
import './App.css';
import Header from './Header'
import College_list from './College_list'
import College_details from "./College_details"
import Student_details from './Student_details'
import LoginForm from './Login_Form'
import { BrowserRouter as Router, Route, Link, Switch } from "react-router-dom";

class App extends Component {
  state = {
    name : '',
    password: ''
  }
  componentDidMount()
  {
    this.setState({name : 'krishna'});
    this.setState({password : 'sairama'});
    //convert the name and password into base64 and send these values ar props
  }
  render() {
    return (
      <div className="App">
        {/* <Header class = 'login-val' title = "Onlineapp" loggedIn = {true}/> */}
        <Router>
          <React.Fragment>
            <Switch>
              <Route exact path="/" component={College_list}/>
              {/* <Route exact path="/" component={LoginForm}/> */}
              <Route exact path = '/colleges/:id/' component={(props) => (<College_details {...props}/>)}/>
              <Route exact path = '/colleges/:college_id/:student_id/' component={(props) => (<Student_details {...props}/>)}/>
            </Switch>
          </React.Fragment>
        </Router>
      </div>
    );
  }
}

export default App;
