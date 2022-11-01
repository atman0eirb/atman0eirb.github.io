import './App.css';
import { useState } from 'react';


function App() {

  const [todolist,addtodolist] = useState([
  ]);

  const [newtodo,addnewtodo] = useState("");

  const take = (event) => {

  }


  const addtolist = (event) => {

    event.preventDefault();

    const copy=[...todolist];
    const nom = newtodo;
    const id = new Date().getTime();
    copy.push({id:id,nom:nom});
    addtodolist(copy);
    addnewtodo("");

  }

  const todelete = (id) => {

    const copy=[...todolist];
    const newtodolist=copy.filter(todolist => todolist.id !== id );
    addtodolist(newtodolist);

  }



  const change = (event) => {
    addnewtodo(event.target.value);
  }

  const DeleteAll = (event) => {
    addtodolist([]);
  }

  return (
    <div id="todo">
      <button onClick={DeleteAll}> Delete List </button>
      <ul>{todolist.map((todolist)=>
      <li key={todolist.id}>{todolist.nom+" "}
      <button id = "delete" onClick={() => todelete(todolist.id)}>
      X </button>
      </li>)}</ul>

      <form action='submit' onSubmit={addtolist}>
        <input  value={newtodo} type='text' placeholder=' add to todo list ' onChange={change}/>
        <button > Add </button>
      </form>
      

    </div>
  );
}

export default App;
