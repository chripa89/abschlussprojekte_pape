import React, { Component } from 'react';
import {  Link } from 'react-router-dom';
import { connect } from 'react-redux'
import '../App.css'
import RecipeAPI from './RecipeAPI';


class startseite extends Component {
    constructor(props) {
        super(props);
        this.logOut = this.logOut.bind(this);
        this.handleCallback = this.handleCallback.bind(this)
        this.state = {
            loggedIn: this.loggedIn,
            mittagEssen: this.mittagEssen,
            kalorienBedarf: this.kalorienBedarf,
            mittagEssenCal: this.mittagEssenCal,
            fruehstueckCal: this.fruehstueckCal,
            abendEssenCal: this.abendEssenCal,
           
            
        }
    }


    logOut() {
        sessionStorage.clear()
        this.setState({

            name: 'Login',
            passwort: 'Passwort'
        })
    }
    componentDidMount() {
        this.setState({
            kalorienBedarf: Math.floor(655.1 + (9.6 * Number(this.props.Members[sessionStorage.getItem('user')].gewicht)) + (1.8 * Number(this.props.Members[sessionStorage.getItem('user')].groesse)) - (4.7 * Number(this.props.Members[sessionStorage.getItem('user')].alter)))
        })

    }

    werteAnpassenGewicht = (event) => {


        this.props.Members[sessionStorage.getItem('user')].gewicht = event.target.value


        this.setState({
            kalorienBedarf: Math.floor(655.1 + (9.6 * Number(this.props.Members[sessionStorage.getItem('user')].gewicht)) + (1.8 * Number(this.props.Members[sessionStorage.getItem('user')].groesse)) - (4.7 * Number(this.props.Members[sessionStorage.getItem('user')].alter)))
        })

    }
    werteAnpassenAlter = (event) => {


        this.props.Members[sessionStorage.getItem('user')].alter = event.target.value

        this.setState({
            kalorienBedarf: Math.floor(655.1 + (9.6 * Number(this.props.Members[sessionStorage.getItem('user')].gewicht)) + (1.8 * Number(this.props.Members[sessionStorage.getItem('user')].groesse)) - (4.7 * Number(this.props.Members[sessionStorage.getItem('user')].alter)))

        })

    }

    handleCallback = (parameter,parameter2,parameter3) => {
       console.log(parameter,parameter2,parameter3);
       
        this.setState({
            mittagEssenCal: parameter,
            fruehstueckCal: parameter2,
            abendEssenCal: parameter3
        })

    }


    render() {
        return (
            <div>
                <Link to="/"  class="logout" onClick={this.logOut}>LogOut</Link>


                <h1 className="alignCenter">Übersicht</h1>
                <h2 className="alignCenter" >Willkommen zurück, <span className="capitalize">{this.props.Members[sessionStorage.getItem('user')].name}</span> !!!</h2>
<div className="sticky">
                <h4 className="alignCenter" > Ihr täglicher Kalorienbedarf beträgt: <span className="green">{this.state.kalorienBedarf + ' kcal'}</span></h4>
                {(this.state.fruehstueckCal> 0 && this.state.mittagEssenCal> 0 && this.state.abendEssenCal> 0)?
                <h4 className="alignCenter "> Kalorien Tages Verbrauch: <span className="red">{this.state.fruehstueckCal + this.state.mittagEssenCal + this.state.abendEssenCal + ' kcal'}</span></h4>: <h4 className="alignCenter">Keine Mahlzeiten ausgewählt!</h4>
            }
              { (this.state.fruehstueckCal> 0 && this.state.mittagEssenCal> 0 && this.state.abendEssenCal> 0)? (<h4 className="alignCenter "> {Math.sign(this.state.fruehstueckCal + this.state.mittagEssenCal + this.state.abendEssenCal - this.state.kalorienBedarf) === -1 
              ?  <span className="green alignCenter">Super {this.state.fruehstueckCal + this.state.mittagEssenCal + this.state.abendEssenCal - this.state.kalorienBedarf + ' kcal  Tagesverbrauch! '}</span>
              :  <span className="red alignCenter">Oh! Dein Verbrauch übersteigt dein Bedarf um {this.state.fruehstueckCal + this.state.mittagEssenCal + this.state.abendEssenCal - this.state.kalorienBedarf + ' kcal ! '}</span>}</h4>
              )   : console.log('false')
              
            
           
        }</div>
            <div class="schub">
                Ihr aktuelles Gewicht:
                &nbsp;
                <input type="number" onChange={this.werteAnpassenGewicht} value={this.props.Members[sessionStorage.getItem('user')].gewicht} id="gewicht" />
                &nbsp;
                Alter
                <input type="number" onChange={this.werteAnpassenAlter} value={this.props.Members[sessionStorage.getItem('user')].alter} id="alter" />
                <br />
                </div>
                <RecipeAPI clickHandler={this.handleCallback}/>
            </div>
        );
    }
}

const mapStateToProps = (state, props) => {
    return {
        ...props,
        Members: state.Members
    }
}


export default connect(mapStateToProps)(startseite);
