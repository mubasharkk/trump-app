import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import TimeSlot from './TimeSlot';
import TwitterFeeds from "./TwitterFeeds";

export default class Dashboard extends Component {
    render() {
        return (
            <div className="row">
                <div className="col-md-4">
                    <TimeSlot/>
                </div>
                <div className="col-md-8">
                    <TwitterFeeds/>
                </div>
            </div>
        );
    }
}

if (document.getElementById('dashboard')) {
    ReactDOM.render(<Dashboard/>, document.getElementById('dashboard'));
}
