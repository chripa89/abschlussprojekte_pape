const initState = {
    Members: [
        {  name: 'peter', passwort: 'lustig',alter: 32, groesse: 165, gewicht: 70 },
        {  name: 'admin', passwort: '12345',alter: 30, groesse: 195, gewicht: 100 }
    ]
};


const rootReducer = (state = initState, action) => {
    switch (action.type) {

        case 'ADD':
            return {
                ...state,
                Members: [ ...state.Members,action.Member]
            }

        
          

        default:
            return state;
    }

}


export default rootReducer;