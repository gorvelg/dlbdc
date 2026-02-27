(() => {
    const { registerBlockType } = wp.blocks;
    const { createElement: el } = wp.element;
    const ServerSideRender = wp.serverSideRender;

    const blocks = window.JM_BLOCKS || [];

    blocks.forEach((meta) => {
        registerBlockType(meta.name, {
            title: meta.title,
            category: meta.category,
            icon: meta.icon,
            description: meta.description,
            keywords: meta.keywords,
            supports: meta.supports,

            // Preview automatique du render.php dans l’éditeur
            edit: (props) => el(ServerSideRender, { block: meta.name, attributes: props.attributes }),

            // Dynamic block -> rendu front en PHP (render.php)
            save: () => null
        });
    });
})();