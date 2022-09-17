import React from "react";
import {
    Routes,
    Route,
    Link,
    Outlet,
    useNavigate,
    Navigate,
} from "react-router-dom";

import Chat from "./App";
import ChatGroup from "./ChatGroup";

function Home() {
    return <h1>Home</h1>;
}

function Dashboard() {
    return (
        <div>
            <h1>Dashboard</h1>
            <nav>
                <Link to="invoices">Invoices</Link> <Link to="team">Team</Link>
            </nav>
            <hr />
            <Outlet />
        </div>
    );
}

function Invoices() {
    return <h1>Invoices</h1>;
}

function Team() {
    return <h1>Team</h1>;
}

function App() {
    let navigate = useNavigate();

    return (
        <Routes>
            {/* <Route
                path="chat/group"
                element={<Navigate to="/chat/group" replace />}
            /> */}
            <Route path="chat">
                <Route path="group" element={<ChatGroup />} />
                <Route path="group/:id" element={<ChatGroup />} />
            </Route>
            {/* <Route path="chat/group">
                <Route path="p" element={<Chat />} />
                <Route path="p/:id" element={<Chat />} />
                <Route path="g" element={<ChatGroup />} />
                <Route path="g/:id" element={<ChatGroup />} />
            </Route> */}
        </Routes>
    );
}

export default App;
