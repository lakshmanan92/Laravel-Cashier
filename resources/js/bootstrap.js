window._ = require('lodash');

try {
    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: false,
    wsHost: process.env.MIX_WEBSOCKET_HOST,
    wsPort: process.env.MIX_WEBSOCKET_PORT,
    wssPort: process.env.MIX_WEBSOCKET_PORT,
    disableStats: true,
    enabledTransports: ['ws', 'wss']
});

window.Echo.channel('score')
 .listen('ScoreUpdate', (e) => {
    console.log(e);
});

window.Echo.channel('my-message')
 .listen('SendMyMessage', (e) => {
    console.log(e);
});
window.Echo.channel('receive-message')
 .listen('ReceiveMyMessage', (e) => {
    console.log(e);
});
const userIdElement = document.getElementById('user-id');
const userId = userIdElement ? userIdElement.value : null;
// Get the message container element
const messageContainer = document.getElementById('messageContainer');

// Function to append a message to the container
function appendMessage(message, type) {
    const messageElement = document.createElement('div');
    messageElement.className = type === 'sent' ? 'sent-message' : 'received-message';
    messageElement.textContent = message;
    messageContainer.appendChild(messageElement);
}

window.Echo.channel('chat.' + userId)
    .listen('MessageSent', (event) => {
        appendMessage(event.message.message, 'sent');
        // Update UI with the received message
        console.log('Received message:', event.message);
    });

// Listen for replied messages
window.Echo.channel('chat.' + userId)
    .listen('MessageReplied', (event) => {
        // Update UI with the replied message
        appendMessage(event.message.message, 'received');
        console.log('Received reply:', event.message);
});
