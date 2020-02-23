import React, { Component } from 'react';
import { Link } from 'react-router-dom'
import Startseite from '../fitness/Startseite';
import { connect } from 'react-redux';


class Login extends Component {



    constructor(props) {
        super(props);
        this.handleChangeLogin = this.handleChangeLogin.bind(this);

        this.einLoggen = this.einLoggen.bind(this);

        this.state = {
            name: '',
            passwort: '',
            groesse: '',
            alter: '',
            gewicht: '',
            loggedIn: false,
            index: ''

        }
    }


    handleChangeLogin = (event) => {
        this.setState({

            [event.target.id]: event.target.value,
        }
            , () => console.log('Login: ' + this.state.name + ' Passwort: ' + this.state.passwort + this.props.Members.map(e => console.log(e)
            )))
    }




    einLoggen(event) {
        event.preventDefault()
        this.props.Members.map((el, index) => {

            if (this.props.Members[index].name === this.state.name && this.props.Members[index].passwort === this.state.passwort) {

                sessionStorage.setItem("loggedIn", '34ljk24lkjn32kjdnkj')
                sessionStorage.setItem("user", index)

                this.setState({
                    loggedIn: true,

                })
            }
            else console.log('FAIL to LOGIN ');

        })


    }




    render() {
        return (

            <React.Fragment>
               

                    {(sessionStorage.getItem("loggedIn") !== '34ljk24lkjn32kjdnkj') ?

                        (< form onSubmit={this.einLoggen} className="schub2 slideInLeft"  >

                            Login - Name<br />
                            < input type="text" onChange={this.handleChangeLogin} placeholder="Login" id="name" />
                            <br />
                            Passwort<br />
                            < input type="password" onChange={this.handleChangeLogin} placeholder="Passwort" id="passwort" />
                            <br />
                            <button    >Login</button>


                            <br />
                            {console.log(this.state.name + ' ' + this.state.passwort)}
                            <br />
                            <Link to="/reg">Registriere dich hier!</Link>

                        </form >) : <Startseite />

                    }



               




            </React.Fragment>
        );
    }
}

const mapStateToProps = (state, props) => {
    return {
        ...props,
        Members: state.Members
    }
}
const mapDispatchToProps = (dispatch) => {
    return {
        addMember: (member) => { dispatch({ type: 'ADD', member: member }) },

    }
}
export default connect(mapStateToProps, mapDispatchToProps)(Login);
