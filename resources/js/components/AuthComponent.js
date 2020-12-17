import React from 'react';
import ReactDOM from 'react-dom';

export default class AuthComponent extends React.Component 
{
    render(){
        return (
            <div class='container'>
                Hello Auth Conponent
            </div>
        );
    }
}

if(document.getElementById('auth')){
    ReactDOM.render(<AuthComponent/>, document.getElementById('auth'));
}