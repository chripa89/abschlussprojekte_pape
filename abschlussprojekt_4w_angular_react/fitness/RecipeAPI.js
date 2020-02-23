import React, { Component } from 'react';
import { connect } from 'react-redux'
import '../App.css'
class RecipeAPI extends Component {



    constructor(props) {
        super(props);
        this.abendEssen = this.abendEssen.bind(this);
        this.mittagEssen = this.mittagEssen.bind(this);
        this.fruehstueck = this.fruehstueck.bind(this);
        this.abendEssenListe = this.abendEssenListe.bind(this);
        this.addShop = this.addShop.bind(this);

        this.state = {
            loading: true,
            rezepteArrayMittagEssen: [],
            rezepteArrayFruestueck: [],
            rezepteArrayAbendessen: [],
            mittagEssenCal: this.mittagEssenCal,
            fruehstueckCal: this.fruehstueckCal,
            abendEssenCal: this.abendEssenCal,
            abendEssenAuswahl: this.abendEssenAuswahl,
            mittagEssenAuswahl: this.mittagEssenAuswahl,
            fruehstueckAuswahl: this.fruehstueckAuswahl,
            fruehstueckZutaten: [],
            mittagEssenZutaten: [],
            abendEssenZutaten: [],
            shoppingList: []

        };
    }


    async componentDidMount() {

        this.abendEssenListe()
        this.fruestueckListe()

        const YOUR_APP_ID = '';
        const YOUR_APP_KEY = '';
        const ESSEN = 'lunch'
        const url = `https://api.edamam.com/search?q=${ESSEN}&app_id=${YOUR_APP_ID}&app_key=${YOUR_APP_KEY}&from=0&to=10`
        const response = await fetch(url);
        const data = await response.json();
        console.log(data.hits);
        this.setState({
            rezepteArrayMittagEssen: data.hits,
        })

    }
    async abendEssenListe() {



        const YOUR_APP_ID = '';
        const YOUR_APP_KEY = '';
        const ESSEN = 'dinner'
        const url = `https://api.edamam.com/search?q=${ESSEN}&app_id=${YOUR_APP_ID}&app_key=${YOUR_APP_KEY}&from=0&to=10`
        const response = await fetch(url);
        const data = await response.json();
        console.log(data.hits);
        this.setState({
            rezepteArrayAbendessen: data.hits,
        })
    }
    async fruestueckListe() {



        const YOUR_APP_ID = '';
        const YOUR_APP_KEY = '';
        const ESSEN = 'breakfast'
        const url = `https://api.edamam.com/search?q=${ESSEN}&app_id=${YOUR_APP_ID}&app_key=${YOUR_APP_KEY}&from=0&to=10`
        const response = await fetch(url);

        const data = await response.json();
        console.log(data.hits);
        this.setState({
            rezepteArrayFruestueck: data.hits,
        })
    }





    mittagEssen(event) {
        let calo = this.state.rezepteArrayMittagEssen[event.target.value].recipe.calories
        let count = this.state.rezepteArrayMittagEssen[event.target.value].recipe.yield
        this.setState({
            mittagEssenCal: Math.floor(calo / count),
            mittagEssenAuswahl: this.state.rezepteArrayMittagEssen[event.target.value].recipe.label,
            mittagEssenBild: this.state.rezepteArrayMittagEssen[event.target.value].recipe.image,
            mittagEssenZutaten: this.state.rezepteArrayMittagEssen[event.target.value].recipe.ingredientLines

        })



    }

    abendEssen(event) {
        let calo = this.state.rezepteArrayAbendessen[event.target.value].recipe.calories
        let count = this.state.rezepteArrayAbendessen[event.target.value].recipe.yield
        this.setState({
            abendEssenCal: Math.floor(calo / count),
            abendEssenAuswahl: this.state.rezepteArrayAbendessen[event.target.value].recipe.label,
            abendEssenBild: this.state.rezepteArrayAbendessen[event.target.value].recipe.image,
            abendEssenZutaten: this.state.rezepteArrayAbendessen[event.target.value].recipe.ingredientLines
        })


    }
    fruehstueck(event) {
        let calo = this.state.rezepteArrayFruestueck[event.target.value].recipe.calories
        let count = this.state.rezepteArrayFruestueck[event.target.value].recipe.yield
        this.setState({
            fruehstueckCal: Math.floor(calo / count),
            fruehstueckAuswahl: this.state.rezepteArrayFruestueck[event.target.value].recipe.label,
            fruehstueckBild: this.state.rezepteArrayFruestueck[event.target.value].recipe.image,
            fruehstueckZutaten: this.state.rezepteArrayFruestueck[event.target.value].recipe.ingredientLines
        })


    }
    sendData = (parameter1, parameter2, parameter3) => {
        this.props.clickHandler(parameter1, parameter2, parameter3);
        console.log('SCHICK: ' + parameter1, parameter2, parameter3);

    }

    addShop(article) {

        if (this.state.shoppingList.indexOf(article) === -1) {
            this.state.shoppingList.push(article)
            console.log('EinkaufsListe: ' + this.state.shoppingList)

            this.setState({
                shoppingList: this.state.shoppingList
            })
        } else {

            console.log('JUHU' + this.state.shoppingList.indexOf(article))
        }
    }




    render() {
        return (
            <>


                <div class="flex">
                    <h2>Frühstück</h2>
                    <select onChange={this.fruehstueck}>
                        <option >Bitte das Frühstück auswählen</option>
                        {this.state.rezepteArrayFruestueck.map((el, index) => <option name="frueh" value={index}>{el.recipe.label + " " + Math.floor(el.recipe.calories / el.recipe.yield) + "kcal Pro Portion"}</option>)}
                    </select>

                    <h4>{this.state.fruehstueckAuswahl}</h4>
                    <img src={this.state.fruehstueckBild} alt="Frühstück" />
                    <div>
                        <ul>
                            {this.state.fruehstueckZutaten.map(el => <li>{el}  <button onClick={() => this.addShop(el)}>add to Shoppinglist</button></li>)}


                        </ul>
                    </div>
                </div>


                <div class="flex">
                    <h2>Mittagessen</h2>
                    <select onChange={this.mittagEssen}>
                        <option >Bitte ein Mittagessen auswählen</option>
                        {this.state.rezepteArrayMittagEssen.map((el, index) => <option value={index}>{el.recipe.label + " " + Math.floor(el.recipe.calories / el.recipe.yield) + "kcal Pro Portion"}</option>)}
                    </select>

                    <h4>{this.state.mittagEssenAuswahl}</h4>
                    <img src={this.state.mittagEssenBild} alt="Mittagessen" />
                    <div>
                        <ul>
                            {this.state.mittagEssenZutaten.map(el => <li>{el}  <button onClick={() => this.addShop(el)}>add to Shoppinglist</button></li>)}


                        </ul>
                    </div>
                </div>


                <div class="flex">
                    <h2>Abendessen</h2>
                    <select onChange={this.abendEssen}>
                        <option >Bitte ein Abendessen auswählen</option>
                        {this.state.rezepteArrayAbendessen.map((el, index) => <option value={index}>{el.recipe.label + " " + Math.floor(el.recipe.calories / el.recipe.yield) + "kcal Pro Portion"}</option>)}
                    </select>
                    <h4>  {this.state.abendEssenAuswahl}</h4>
                    <img src={this.state.abendEssenBild} alt="Abendessen" />
                    <div>
                        <ul>
                            {this.state.abendEssenZutaten.map(el => <li>{el}  <button onClick={() => this.addShop(el)}>add to Shoppinglist</button></li>)}


                        </ul>
                        <br /> <br /> <br /> <br /> <br /> <br /> <br />
                      
                    </div>
                </div>
                {this.sendData(this.state.fruehstueckCal, this.state.mittagEssenCal, this.state.abendEssenCal)}

                <div className="test">
                    <h3>Einkaufsliste <button onClick={() => window.print()}>Print</button></h3>
                    <ul className="einkaufsliste">


                        {(this.state.shoppingList.length > 0) ?



                            this.state.shoppingList.map(el => <li> 	&ordm; {el}</li>) : <li className="noEditing">Shoppinglist is empty</li>}


                    </ul>
                </div>
            </>
        );
    }
}

const mapStateToProps = (state, props) => {
    return {
        ...props,

    }
}


export default connect(mapStateToProps)(RecipeAPI);


