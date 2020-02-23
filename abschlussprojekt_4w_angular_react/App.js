import React from 'react';
import { BrowserRouter, Route, Switch } from 'react-router-dom';
import Login from './login-reg/Login';
import registrierung from './login-reg/Registrierung';
import startseite from './fitness/Startseite';


function App() {



  return (
    <>

      <BrowserRouter>
        <div >
          <header>
            <h1 className="slideInLeft sticky">FitnessApp</h1>
          </header>
        </div>


        <Switch>
          <Route path="/startseite" exact component={startseite} />
          <Route path="/" exact component={Login} />
          <Route path="/reg" exact component={registrierung} />
        </Switch>
      </BrowserRouter>


    </>
  );
}

export default App;
