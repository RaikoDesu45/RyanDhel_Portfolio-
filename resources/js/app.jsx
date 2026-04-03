import React from 'react';
import { createRoot } from 'react-dom/client';
import './bootstrap';
import '../css/app.css';
import PortfolioApp from './portfolio/PortfolioApp';

const mountNode = document.getElementById('app');

if (mountNode) {
    let initialProps = {};

    try {
        initialProps = JSON.parse(mountNode.dataset.props || '{}');
    } catch {
        initialProps = {};
    }

    createRoot(mountNode).render(
        <React.StrictMode>
            <PortfolioApp {...initialProps} />
        </React.StrictMode>
    );
}
