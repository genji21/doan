import { Switch } from "react-router-dom";
import "./App.scss";
import HomePage from "./Pages/ClientPages/HomePage";
import NewDetail from "./Pages/ClientPages/NewDetail/NewDetail";
import { MainTemplate } from "./Templates/MainTemplate";

function App() {
  return (
    <Switch>
      <MainTemplate exact path="/" Component={HomePage} />
      <MainTemplate exact path="/detail" Component={NewDetail} />
    </Switch>
  );
}

export default App;
