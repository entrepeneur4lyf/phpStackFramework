#!/bin/bash

# Start the PHP server in the background
php -S localhost:8000 -t public &
SERVER_PID=$!

# Wait for 3 seconds
sleep 3

# Gracefully terminate the server
kill -TERM $SERVER_PID

# Wait for the process to finish
wait $SERVER_PID

echo "Server has been gracefully shut down after 3 seconds."