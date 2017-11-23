import React, {Component} from 'react';
import {Parser} from 'html-to-react';
import moment from 'moment';

class Twitter extends Component {

    constructor(props) {
        super(props);
        this.htmlParser = new Parser;
        this.state = {
            data: props.data
        }
    }

    parseTime(timestamp) {
        let now = moment();
        now.subtract({ hours: 4 });
        let ts = moment.unix(timestamp);
        return now.isBefore(ts) ? ts.fromNow() : ts.format('lll');
    }

    render() {
        return (
            <article className="timeline-entry">
                <div className="timeline-entry-inner">
                    <div className="timeline-icon bg-info">
                        <i className="fa fa-twitter"></i>
                    </div>
                    <div className="timeline-label">
                        <h2>
                            <a href={this.state.data.user.url} target="_blank">{this.state.data.user.name}</a>
                            &nbsp;&nbsp;
                            <span>posted at {this.parseTime(this.state.data.timestamp)}</span>
                        </h2>
                        <p>{this.htmlParser.parse(this.state.data.text_html)}</p>
                    </div>
                </div>
            </article>
        );
    }

}

export default Twitter;