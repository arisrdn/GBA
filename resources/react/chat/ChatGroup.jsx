import React from "react";
import Chat from "./Chat";
import { useEffect, useRef, useState } from "react";
import ReactLoading from "react-loading";
import { Link, useParams, useNavigate } from "react-router-dom";
import { onMessageListener } from "../firebase";
import { API } from "../url";
import Moment from "moment";

function App() {
    let { id } = useParams();
    let navigate = useNavigate();
    const [error, setError] = useState(null);
    const [isLoaded, setIsLoaded] = useState(false);
    const [items, setItems] = useState([]);
    const [q, setQ] = useState("");
    const [searchParam] = useState(["name"]);
    const [auth, setAuth] = useState(false);
    const [message, setMessage] = useState(false);
    const [chat, setChat] = useState(null);
    const [isDisabled, setIsDisabled] = useState(false);
    const [state, setState] = useState({ message: "", to_id: "" });

    const messagesEndRef = useRef(null);
    const scrollToBottom = () => {
        messagesEndRef.current?.scrollIntoView({ behavior: "smooth" });
    };
    const getContact = () => {
        fetch(API + "/contact/group")
            .then((res) => res.json())
            .then(
                (result) => {
                    // console.log(result);

                    setIsLoaded(true);
                    setItems(result.data);
                },
                (error) => {
                    setIsLoaded(true);
                    setError(error);
                }
            );
    };

    const getMessages = () => {
        fetch(API + "/messages/g/" + id)
            .then((res) => res.json())
            .then((result) => {
                // console.log(result);
                // setIsLoaded(true);
                setChat(result.data);
            });
    };

    const sendMessage = async () => {
        setIsDisabled(true);
        const requestOptions = {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            body: JSON.stringify(state),
        };
        await fetch(API + "/messages/g", requestOptions)
            .then((response) => response.text())
            .then((data) => {
                // console.log(data);
                getMessages();
                setState({ ...state, message: "" });
                setIsDisabled(false);
                getContact();
            })
            .catch((error) => console.log(error));
    };
    const getUserDetail = () => {
        fetch(API + "/g/" + id)
            .then((res) => res.json())
            .then((result) => {
                console.log(result);
                // setIsLoaded(true);
                setMessage(result.data);
            });
    };
    onMessageListener()
        .then((payload) => {
            // setNotification({
            //     title: payload.notification.title,
            //     body: payload.notification.body,
            // });
            getMessages();
            console.log(payload);
        })
        .catch((err) => console.log("failed: ", err));

    useEffect(() => {
        getContact();
        fetch(API + "/auth")
            .then((res) => res.json())
            .then((result) => {
                setAuth(result.data);
            });
    }, []);

    useEffect(() => {
        if (id) {
            getMessages();
            getUserDetail();
            setIsLoaded(true);
            setState({ ["to_id"]: id, message: "" });
        }
    }, [id]);
    useEffect(() => {
        scrollToBottom();
    }, [chat]);

    const data = Object.values(items);

    function search(items) {
        return items.filter((item) => {
            return searchParam.some((newItem) => {
                return (
                    item[newItem]
                        .toString()
                        .toLowerCase()
                        .indexOf(q.toLowerCase()) > -1
                );
            });
        });
    }

    const handleSubmit = (event) => {
        event.preventDefault();

        sendMessage();
        // console.log("submitting", state);
    };

    const handleChange = (event) => {
        const name = event.target.name;
        const value = event.target.value;
        setState({ ...state, [name]: value });
    };

    if (error) {
        return <p>{error.message},</p>;
    }
    const Loading = ({ type = "spin", color = "black" }) => (
        <div className="h-100 d-flex justify-content-center align-items-center">
            <ReactLoading
                type={type}
                color={color}
                height={"20%"}
                width={"20%"}
            />
        </div>
    );
    return (
        <div className="row">
            <div className="col-4">
                <div className="people-list" id="people-list">
                    <div className="search">
                        <div id="search">
                            <label htmlFor="">
                                <i
                                    className="fa fa-search"
                                    aria-hidden="true"
                                ></i>
                            </label>
                            <input
                                type="text"
                                placeholder="Search contacts..."
                                autoComplete="off"
                                name="search-form"
                                id="search-form"
                                className="search-input"
                                value={q}
                                onChange={(e) => setQ(e.target.value)}
                            />
                        </div>
                    </div>
                    <ol className="nav nav-tabs nav-justified">
                        <li className="nav-item">
                            <Link to="/chat/p" className="nav-link ">
                                User
                            </Link>
                        </li>
                        <li className="nav-item">
                            <Link to="/chat/g" className="nav-link active ">
                                Group
                            </Link>
                        </li>
                    </ol>
                    <div id="contacts">
                        <ul className="list">
                            {!isLoaded ? (
                                <Loading />
                            ) : (
                                search(data).map((item) => (
                                    <Link
                                        to={"/chat/g/" + item.id}
                                        key={item.id}
                                    >
                                        <li
                                            className={
                                                id == item.id
                                                    ? "clearfix  active"
                                                    : "clearfix "
                                            }
                                            // onClick={() => setIsActive(item.id)}
                                            // onClick={(event) => handleClick(item)}
                                        >
                                            <img
                                                src={
                                                    "https://ui-avatars.com/api/?name=" +
                                                    item.name
                                                }
                                                alt="avatar"
                                            />

                                            <div className="about">
                                                {/* <Link to={user.id}>{user.name}</Link> */}
                                                <div className="name">
                                                    {item.name}
                                                </div>
                                                <div className="status">
                                                    {item.last_chat != null ? (
                                                        <>
                                                            <i className="fas fa-comment"></i>{" "}
                                                            {item.last_chat
                                                                .message
                                                                ? item.last_chat.message?.substring(
                                                                      0,
                                                                      20
                                                                  ) + "..."
                                                                : ""}
                                                        </>
                                                    ) : (
                                                        <>
                                                            <i className="fas fa-comment-slash"></i>{" "}
                                                            Tidak ada pesan
                                                        </>
                                                    )}
                                                </div>
                                            </div>
                                        </li>
                                    </Link>
                                ))
                            )}
                        </ul>
                    </div>
                </div>
            </div>

            {/* <Chat message={message} /> */}
            <div className="col">
                <div className="chat">
                    {id ? (
                        <div className="chat-header clearfix">
                            {message.photo_profile ? (
                                <img
                                    src={
                                        "https://ui-avatars.com/api/?name=" +
                                        message.name
                                    }
                                    alt="avatar"
                                />
                            ) : (
                                <img
                                    src={
                                        "https://ui-avatars.com/api/?name=" +
                                        message.name
                                    }
                                    alt="avatar"
                                />
                            )}

                            <div className="chat-about">
                                <div className="chat-with">{message.name}</div>
                                <div className="chat-num-messages">
                                    {chat?.length} messages
                                </div>
                            </div>
                        </div>
                    ) : (
                        <div className="chat-header clearfix">
                            <div className="chat-about">
                                <div className="chat-with">Pilih Chat</div>
                                <div className="chat-num-messages"></div>
                            </div>
                        </div>
                    )}

                    <div className="chat-history">
                        <ul>
                            {id ? (
                                chat?.length === 0 ? (
                                    <div className="h-100 d-flex justify-content-center align-items-center">
                                        <div
                                            className="empty-state"
                                            data-height="400"
                                            // style="height: 400px;"
                                        >
                                            <div className="empty-state-icon bg-secondary">
                                                <i className="far fa-comment-dots "></i>
                                            </div>
                                            <h2>Tida ada percakapan</h2>
                                            <p className="lead"></p>
                                        </div>
                                    </div>
                                ) : (
                                    chat?.map((item) => (
                                        <li className="clearfix" key={item.id}>
                                            {item.from_id == auth.id ? (
                                                <>
                                                    <div className="message-data align-right">
                                                        <span className="message-data-time">
                                                            {Moment(
                                                                item?.created_at
                                                            ).format(
                                                                "DD-mm-yyyy hh:mm:ss"
                                                            )}
                                                        </span>
                                                        <span className="message-data-name">
                                                            {" "}
                                                            {item?.sender?.name}
                                                        </span>{" "}
                                                        <i className="fa fa-circle me"></i>
                                                    </div>
                                                    <div className="message other-message float-right">
                                                        {item.message}
                                                    </div>
                                                </>
                                            ) : (
                                                <>
                                                    <div className="message-data">
                                                        <span className="message-data-name">
                                                            <i className="fa fa-circle online"></i>{" "}
                                                            {item?.sender?.name}
                                                        </span>
                                                        <span className="message-data-time">
                                                            {Moment(
                                                                item?.created_at
                                                            ).format(
                                                                "DD-mm-yyyy hh:mm:ss"
                                                            )}
                                                        </span>
                                                    </div>
                                                    <div className="message my-message">
                                                        {item.message}
                                                    </div>
                                                </>
                                            )}
                                        </li>
                                    ))
                                )
                            ) : (
                                <div className="h-100 d-flex justify-content-center align-items-center">
                                    <div
                                        className="empty-state"
                                        data-height="400"
                                        // style="height: 400px;"
                                    >
                                        <div className="empty-state-icon ">
                                            <i className="far fa-comment"></i>
                                        </div>
                                        <h2>Tidak ada pesan</h2>
                                        <p className="lead">
                                            Silahkan pilih Chat
                                        </p>
                                    </div>
                                </div>
                            )}
                        </ul>
                        <div ref={messagesEndRef} />
                    </div>

                    <div
                        className="chat-message clearfix"
                        onSubmit={handleSubmit}
                    >
                        <form className="msger-inputarea">
                            <input
                                type="text"
                                className="msger-input "
                                placeholder="Enter your message..."
                                onChange={handleChange}
                                name="message"
                                value={state.message}
                                disabled={id ? false : true}
                                required
                            />
                            <input
                                type="submit"
                                disabled={id ? false : true}
                                className={
                                    isDisabled
                                        ? "msger-send-btn btn disabled btn-primary btn-progress"
                                        : "msger-send-btn btn btn-primary "
                                }
                                value="send"
                            />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default App;
