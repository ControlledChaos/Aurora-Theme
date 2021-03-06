// @flow
import { FETCH_POSTS, FETCH_POST, CURRENT_POST_PAGE } from './actions';

// Define the default state.
const DEFAULT_STATE = {
  posts: [],
  post: null,
  isFetched: false,
  totalPosts: 0,
  totalPages: 0,
  currentPage: 0
};

// Takes in state an action, and returns a new state.
/**
 * Updates state by taking in state and an action, and returns a new state.
 *
 * @param {any} state The state of our reducer.
 * @param {object} action The action of the reducer.
 * @returns {object} The new state.
 */
const fetchPosts = (state, action) =>
  Object.assign({}, state, {
    posts: action.payload.posts,
    isFetched: true,
    totalPosts: action.payload.totalPosts,
    totalPages: action.payload.totalPages
  });

const fetchPost = (state, action) =>
  Object.assign({}, state, { post: action.payload });

const setCurrentPostPage = (state, action) =>
  Object.assign({}, state, { currentPage: action.payload });

/**
 * Using the action.type, determine whether to update state, or get current state.
 *
 * @param {object} [state=DEFAULT_STATE] The state passed to the reducer.
 * @param {object} action The action object.
 * @returns {object} A state object.
 */
const rootReducer = (state: Object = DEFAULT_STATE, action: Object) => {
  switch (action.type) {
    case FETCH_POSTS:
      return fetchPosts(state, action);
    case FETCH_POST:
      return fetchPost(state, action);
    case CURRENT_POST_PAGE:
      return setCurrentPostPage(state, action);
    default:
      return state;
  }
};

export default rootReducer;
