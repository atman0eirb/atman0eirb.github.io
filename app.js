let n = 0


function number(n){
    return n.toString().padStart(2,'0')

}

function render(){

    // const title = React.createElement('h1',{},' Bonjour tout le monde ',
    // React.createElement('span',{},n));

    const items =[
        'Tache 1',
        'Tache 2',
        'Tache 3',
    ]

    
    const title = <React.Fragment>
        <h1 className = "title" id = "title">
        Bonjour les gens <span>{number(n)}</span>
        </h1>
        <ul>{items.map((item,k) => <li key={k}>{item}</li> )}</ul>
        </React.Fragment>

    ReactDOM.render(title,document.querySelector("#app"));  
}

render()


window.setInterval(() => {
    n++
    render()
},1000)
