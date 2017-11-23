import React, {Component} from 'react';
import moment from 'moment';

class TimeSlot extends Component {

    constructor(props) {
        super(props);

        this.state = {
            feeds: [],
            dateTimeSlot: moment().format('DD.MM.YYYY H:00'),
            timeSlots: []
        }

        this.handleSubmit = this.handleSubmit.bind(this);
    }

    componentWillMount() {

    }

    componentDidMount() {
        $("#time-slot").datetimepicker({
            minDate: 0,
            minTime: 0,
            onSelectDate: this.setDateTime
        });
    }

    setDateTime(currentDateTime) {
        // 'this' is jquery object datetimepicker
        if (currentDateTime.getDay() == 3) {
            this.setOptions({
                minTime: 0
            });
        } else {
            this.setOptions({
                minTime: '00:00'
            });
        }
    }

    handleChange(event) {
        this.setState({
            dateTimeSlot: event.target.value
        });
    }

    handleSubmit(event) {
        let timeSlots = this.state.timeSlots;
        timeSlots.push(this.state.dateTimeSlot);
        this.setState({
            timeSlots: timeSlots
        });
        event.preventDefault();
    }

    renderTimeSlots() {
        let rows = [];
        for (let i in this.state.timeSlots) {
            rows.push(
                <tr key={i}>
                    <td>{parseInt(i)+1}</td>
                    <td>{this.state.timeSlots[i]}</td>
                </tr>
            )
        }

        return rows;
    }

    render() {
        return (
            <div>
                <form onSubmit={this.handleSubmit} method={'POST'}>
                    <div className="panel panel-default">
                        <div className="panel-heading">
                            Enter your guesses!
                        </div>
                        <div className="panel-body">
                            <div className="form-group">
                                <label htmlFor="time-slot">Select a date</label>
                                <input
                                    className="form-control"
                                    id="time-slot"
                                    name="time-slot"
                                    type="text"
                                    required="1"
                                    autoComplete={'0'}
                                    value={this.state.dateTimeSlot}
                                    onChange={this.handleChange}
                                />
                            </div>
                            <hr/>
                            <div className="">
                                <table className="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {this.renderTimeSlots()}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div className="panel-footer overflow-fix">
                            <button type="submit" className="btn btn-primary pull-right">
                                <i className="fa fa-save fa-fw"></i> Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        );
    }

}

export default TimeSlot;