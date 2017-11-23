import React, {Component} from 'react';
import axios from 'axios';
import Twitter from './Feed/Twitter';

class TwitterFeeds extends Component {

    constructor (props) {
        super(props);

        this.state = {
            feeds : []
        }
    }

    componentWillMount() {
        axios.get('/api/twitter/feeds').then(response => {
            if (response.data.status){
                this.setState({
                    feeds: response.data.data
                });
            }
        });
    }

    componentDidMount() {

    }

    renderFeeds() {
        var feeds = [];
        for(var i in this.state.feeds) {
            feeds.push(<Twitter data={this.state.feeds[i]} key={this.state.feeds[i].id}/>);
        }
        return feeds;
    }

    render() {
        return (
            <div className="row">
                <div className="timeline-centered">
                    {this.renderFeeds()}
                </div>
            </div>

        );
    }

}

export default TwitterFeeds;