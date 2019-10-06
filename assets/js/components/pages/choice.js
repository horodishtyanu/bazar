import React from 'react';

class Choice extends React.Component{

    componentDidMount(){
        this.props.loadData();
    }

    render(){
        const {items, order} = this.props;

        return(
            <React.Fragment>
                <div className="activation-title">Выберите программы</div>
                <div className="activation-widget">
                    <div className="activation-widget-block">
                        <div className="activation-radios">
                            <div className="activation-radios__title">Антивирусы</div>
                            <ul className="radios-list">
                                <li>
                                    <div className="radio-block">
                                        <input type="radio" className="radio" name="name-1" id="radio-id-1"/>
                                            <label htmlFor="radio-id-1" className="radio-label">Выбор несколько
                                                антивирусов</label>
                                    </div>
                                </li>
                                <li>
                                    <div className="radio-block">
                                        <input type="radio" className="radio" name="name-1" id="radio-id-2"/>
                                            <label htmlFor="radio-id-2" className="radio-label">Выбор несколько
                                                антивирусов, через запятую в две строки</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div className="activation-radios">
                            <div className="activation-radios__title">Мультимедиапродукты</div>
                            <ul className="radios-list">
                                <li>
                                    <div className="radio-block">
                                        <input type="radio" className="radio" name="name-2" id="radio-id-3"/>
                                            <label htmlFor="radio-id-3" className="radio-label">Выбор несколько
                                                антивирусов</label>
                                    </div>
                                </li>
                                <li>
                                    <div className="radio-block">
                                        <input type="radio" className="radio" name="name-2" id="radio-id-4"/>
                                            <label htmlFor="radio-id-4" className="radio-label">Выбор несколько
                                                антивирусов, через запятую в две строки</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div className="activation-radios">
                            <div className="activation-radios__title">Компьютерные сервисы</div>
                            <ul className="radios-list">
                                <li>
                                    <div className="radio-block">
                                        <input type="radio" className="radio" name="name-3" id="radio-id-5"/>
                                            <label htmlFor="radio-id-5" className="radio-label">Выбор несколько
                                                антивирусов</label>
                                    </div>
                                </li>
                                <li>
                                    <div className="radio-block">
                                        <input type="radio" className="radio" name="name-3" id="radio-id-6"/>
                                            <label htmlFor="radio-id-6" className="radio-label">Выбор несколько
                                                антивирусов, через запятую в две строки</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </React.Fragment>
        )
    }
}
export default Choice;