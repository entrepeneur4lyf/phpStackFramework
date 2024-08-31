class WebSocketHandler {
    constructor(url) {
        this.url = url;
        this.connect();
    }

    connect() {
        this.socket = new WebSocket(this.url);
        this.socket.onopen = () => console.log('WebSocket connected');
        this.socket.onmessage = this.handleMessage.bind(this);
        this.socket.onclose = () => {
            console.log('WebSocket disconnected. Reconnecting...');
            setTimeout(() => this.connect(), 5000);
        };
        this.socket.onerror = (error) => console.error('WebSocket error:', error);
    }

    handleMessage(event) {
        const data = JSON.parse(event.data);
        switch (data.action) {
            case 'update':
                this.handleUpdate(data.component, data.diff);
                break;
            // Add more cases for different actions as needed
        }
    }

    handleUpdate(componentName, diff) {
        const componentElement = document.querySelector(`[data-component="${componentName}"]`);
        if (componentElement) {
            this.applyDiff(componentElement, diff);
        }
    }

    applyDiff(element, diff) {
        diff.forEach(change => {
            const target = this.getElementByPath(element, change.path);
            switch (change.action) {
                case 'replace':
                    target.outerHTML = change.content;
                    break;
                case 'setAttribute':
                    target.setAttribute(change.name, change.value);
                    break;
                case 'removeAttribute':
                    target.removeAttribute(change.name);
                    break;
                case 'append':
                    target.insertAdjacentHTML('beforeend', change.content);
                    break;
                case 'remove':
                    target.remove();
                    break;
            }
        });
    }

    getElementByPath(root, path) {
        return path.split('/').reduce((element, index) => {
            return index ? element.children[parseInt(index) - 1] : element;
        }, root);
    }

    requestUpdate(componentName, data = {}) {
        if (this.socket.readyState === WebSocket.OPEN) {
            const componentElement = document.querySelector(`[data-component="${componentName}"]`);
            const oldContent = componentElement ? componentElement.outerHTML : '';
            this.socket.send(JSON.stringify({
                action: 'update',
                component: componentName,
                data: data,
                oldContent: oldContent
            }));
        } else {
            console.warn('WebSocket is not open. Update request not sent.');
        }
    }
}

// Usage:
const wsHandler = new WebSocketHandler('ws://localhost:8080');
// wsHandler.requestUpdate('user-profile', { userId: 123 });
