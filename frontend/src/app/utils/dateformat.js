import moment from 'moment';

export function fromUnix(ts, format = 'DD MMM YYYY') {
  return moment.unix(ts).format(format)
}
