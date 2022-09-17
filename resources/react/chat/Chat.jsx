import React from "react";
import { useEffect, useRef, useState } from "react";
import Moment from "moment";
import { onMessageListener } from "../firebase";
import { useParams } from "react-router-dom";

const Chat = (params) => {
    // console.log(params);
    let { id, type } = useParams();
    const messages = params?.message;
    const [notification, setNotification] = useState({ title: "", body: "" });
    const [show, setShow] = useState(false);
    const messagesEndRef = useRef(null);
    const [chat, setChat] = useState(null);
    const [isLoaded, setIsLoaded] = useState(false);
    const [isDisabled, setIsDisabled] = useState(false);
    const [state, setState] = useState({ message: "", to_id: "" });
    const scrollToBottom = () => {
        messagesEndRef.current?.scrollIntoView({ behavior: "smooth" });
    };
    const getMessages = () => {
        fetch("https://gba.test/messages/" + messages?.id)
            .then((res) => res.json())
            .then((result) => {
                console.log(result);
                // setIsLoaded(true);
                setChat(result.data);
            });
    };

    onMessageListener()
        .then((payload) => {
            setNotification({
                title: payload.notification.title,
                body: payload.notification.body,
            });
            setShow(true);
            getMessages();
            console.log(payload);
        })
        .catch((err) => console.log("failed: ", err));
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
        await fetch("https://gba.test/chat", requestOptions)
            .then((response) => response.text())
            .then((data) => {
                // console.log(data);
                getMessages();
                setState({ ...state, message: "" });
                setIsDisabled(false);
            })
            .catch((error) => console.log(error));
    };
    useEffect(() => {
        getMessages();
        setIsLoaded(true);
        setState({ ["to_id"]: messages.id, message: "" });
    }, [messages]);

    // console.log(JSON.stringify(state));

    useEffect(() => {
        scrollToBottom();
    }, [chat]);

    const handleSubmit = (event) => {
        event.preventDefault();

        sendMessage();
        console.log("submitting", state);
    };

    const handleChange = (event) => {
        const name = event.target.name;
        const value = event.target.value;
        setState({ ...state, [name]: value });
    };

    return (
        <div className="col">
            <div className="chat">
                {params.message ? (
                    <div className="chat-header clearfix">
                        {params.message.photo_profile ? (
                            <img
                                src={
                                    "https://ui-avatars.com/api/?name=" +
                                    params.message.name
                                }
                                alt="avatar"
                            />
                        ) : (
                            <img
                                src={
                                    "https://ui-avatars.com/api/?name=" +
                                    params.message.name
                                }
                                alt="avatar"
                            />
                        )}

                        <div className="chat-about">
                            <div className="chat-with">
                                {params.message.name}
                            </div>
                            <div className="chat-num-messages">
                                {chat.length} messages
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
                        {params.message ? (
                            chat.length === 0 ? (
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
                                        {item.to_id == messages.id ? (
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
                                    <p className="lead">Silahkan pilih Chat</p>
                                </div>
                            </div>
                        )}
                    </ul>
                    <div ref={messagesEndRef} />
                </div>

                <div className="chat-message clearfix" onSubmit={handleSubmit}>
                    <form className="msger-inputarea">
                        <input
                            type="text"
                            className="msger-input "
                            placeholder="Enter your message..."
                            onChange={handleChange}
                            name="message"
                            value={state.message}
                            disabled={messages ? false : true}
                            required
                        />
                        <input
                            // name="submit"
                            type="submit"
                            disabled={messages ? false : true}
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
    );
};

export default Chat;
