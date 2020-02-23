import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import { connect } from 'react-redux';
class Registrierung extends Component {


    constructor(props) {
        super(props);
        this.pushUser = this.pushUser.bind(this)
        this.state = {
            name: '',
            passwort: '',
            alter: '',
            groesse: '',
            gewicht: '',

        }
    }


    userReg = (event) => {



        this.setState({
            [event.target.id]: event.target.value

        }
            , () => console.log(this.state))

    }




    pushUser(event) {
        event.preventDefault()
        if (this.state.name !== '') {
            if (this.state.passwort === this.state.checkPasswort) {
                if (this.state.alter < 100 && this.state.alter > 0 && this.state.alter != '') {
                    if (this.state.groesse < 220 && this.state.groesse > 50 && this.state.groesse != '') {
                        if (this.state.gewicht < 220 && this.state.gewicht > 50 && this.state.groesse != '') {
                            this.props.addMember({ name: this.state.name, passwort: this.state.passwort, alter: this.state.alter, groesse: this.state.groesse, gewicht: this.state.gewicht })

                            alert('erfolgreich registriert!')
                        } else alert('Bitte geben Sie ein korretes Gewicht an')
                    } else alert('Bitte geben Sie eine korrekte Größe an')
                } else alert('Bitte geben Sie ein korrektes Alter an')
            } else alert('PASSWORT stimmt nicht überein');
        } else alert('Bitte Login-Name angeben!')
    }


    render() {
        return (
            <React.Fragment>
                <form onSubmit={this.pushUser} className="schub2 slideInLeft">
                    Login-Name<br />
                    <input type="text" onChange={this.userReg} id="name" />
                    <br />
                    Passwort<br />
                    <input type="password" onChange={this.userReg} id="passwort" />
                    <br />
                    Passwort überprüfen<br />
                    <input type="password" onChange={this.userReg} id="checkPasswort" />
                    <br />
                    Alter<br />
                    <input type="number" onChange={this.userReg} id="alter" />
                    <br />
                    Größe in cm<br />
                    <input type="number" onChange={this.userReg} id="groesse" />
                    <br />
                    Gewicht in kg<br />
                    <input type="number" onChange={this.userReg} id="gewicht" />
                    <br />
                    <button  >Registrieren</button>
                    <br />
                    <br />
                    <Link to="/">zum Login</Link>
                </form>
                <br />

            </React.Fragment>
        );
    }
}

const mapStateToProps = (state, props) => {
    return {
        ...props,
        Member: state.member
    }
}
const mapDispatchToProps = (dispatch) => {
    return {
        addMember: (member) => { dispatch({ type: 'ADD', Member: member }) },

    }
}

export default connect(mapStateToProps, mapDispatchToProps)(Registrierung);