
import React, { Component } from 'react'
class Form extends Component {

    constructor(props) {
        super(props)

        this.state = {
            name: 'Fritz',
            alter: 25
        }
    }

    handleChange = (event) => {
        this.setState({
            [event.target.id]: event.target.value
        })
    }

    handleSubmit = (event) => {
        event.preventDefault()
        console.log(this.state.name, this.state.alter)
    }

    render() {
        return (
            <div>
                <h2>{this.state.name}, {this.state.alter}</h2>
                <form onSubmit={this.handleSubmit}>
                    <input type='text' onChange={this.handleChange} value={this.state.name} id='name' /><br />
                    <input type='text' onChange={this.handleChange} value={this.state.alter} id='alter' /><br />
                    <button>Bestätigen</button>
                </form>
            </div>
        )
    }
}

export default Form